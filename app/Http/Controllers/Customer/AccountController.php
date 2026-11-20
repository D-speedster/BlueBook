<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreAddressRequest;
use App\Http\Requests\Customer\UpdateAddressRequest;
use App\Http\Requests\Customer\UpdatePasswordRequest;
use App\Http\Requests\Customer\UpdateProfileRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display the customer account dashboard
     */
    public function index()
    {
        $user = Auth::user();
        $addressCount = $user->addresses()->count();
        
        return view('account.index', compact('addressCount'));
    }

    /**
     * Show profile edit form
     */
    public function profile()
    {
        return view('account.profile');
    }

    /**
     * Update profile information
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'اطلاعات حساب با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Update password
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'رمز عبور فعلی اشتباه است.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'رمز عبور با موفقیت تغییر کرد.');
    }

    /**
     * Display addresses list
     */
    public function addresses()
    {
        $addresses = Auth::user()->addresses()->latest()->get();
        
        return view('account.addresses.index', compact('addresses'));
    }

    /**
     * Show create address form
     */
    public function createAddress()
    {
        return view('account.addresses.create');
    }

    /**
     * Store new address
     */
    public function storeAddress(StoreAddressRequest $request)
    {
        $address = Auth::user()->addresses()->create($request->validated());

        // Set as default if requested or if it's the first address
        if ($request->boolean('is_default') || Auth::user()->addresses()->count() === 1) {
            $address->setAsDefault();
        }

        return redirect()->route('account.addresses')
            ->with('success', 'نشانی با موفقیت ثبت شد.');
    }

    /**
     * Show edit address form
     */
    public function editAddress(Address $address)
    {
        // Authorize: user can only edit their own addresses
        if ($address->user_id !== Auth::id()) {
            abort(403, 'شما اجازه دسترسی به این نشانی را ندارید.');
        }

        return view('account.addresses.edit', compact('address'));
    }

    /**
     * Update address
     */
    public function updateAddress(UpdateAddressRequest $request, Address $address)
    {
        // Authorize: user can only update their own addresses
        if ($address->user_id !== Auth::id()) {
            abort(403, 'شما اجازه دسترسی به این نشانی را ندارید.');
        }

        $address->update($request->validated());

        // Set as default if requested
        if ($request->boolean('is_default')) {
            $address->setAsDefault();
        }

        return redirect()->route('account.addresses')
            ->with('success', 'نشانی با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Delete address
     */
    public function destroyAddress(Address $address)
    {
        // Authorize: user can only delete their own addresses
        if ($address->user_id !== Auth::id()) {
            abort(403, 'شما اجازه دسترسی به این نشانی را ندارید.');
        }

        $wasDefault = $address->is_default;
        $address->delete();

        // If deleted address was default, set another as default
        if ($wasDefault) {
            $newDefault = Auth::user()->addresses()->first();
            if ($newDefault) {
                $newDefault->setAsDefault();
            }
        }

        return back()->with('success', 'نشانی با موفقیت حذف شد.');
    }

    /**
     * Set address as default
     */
    public function setDefaultAddress(Address $address)
    {
        // Authorize: user can only set their own addresses as default
        if ($address->user_id !== Auth::id()) {
            abort(403, 'شما اجازه دسترسی به این نشانی را ندارید.');
        }

        $address->setAsDefault();

        return back()->with('success', 'نشانی پیش‌فرض تغییر کرد.');
    }
}
