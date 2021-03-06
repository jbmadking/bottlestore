<?php
namespace Step\Acceptance;

use App\Repositories\Address;
use App\Repositories\Product;

class SiteUser extends \AcceptanceTester
{

    public function fillInBillingAddress()
    {
        $I = $this;

        $I->fillField('billing[street_number]', '36');
        $I->fillField('billing[street_name]', 'McGhie Avenue');
        $I->fillField('billing[suburb]', 'Rhodene');
        $I->fillField('billing[city]', 'Masvingo');
        $I->fillField('billing[province]', 'Masvingo');
        $I->fillField('billing[postal_code]', '9999');
    }

    public function fillInShippingAddress()
    {
        $I = $this;

        $I->fillField('shipping[street_number]', '36');
        $I->fillField('shipping[street_name]', 'McGhie Avenue');
        $I->fillField('shipping[suburb]', 'Rhodene');
        $I->fillField('shipping[city]', 'Masvingo');
        $I->fillField('shipping[province]', 'Masvingo');
        $I->fillField('shipping[postal_code]', '9999');
    }

    public function fillInLoginForm()
    {
        $I = $this;
        $I->fillField('email', 'jbmatikinye@gmail.com');
        $I->fillField('password', 'joshua');
        $I->click('login_user');
    }

    public function fillInRegistrationForm()
    {
        $I = $this;

        $I->fillField('name', 'Lindsay Matikinye');
        $I->fillField('email', 'lincemat@matikinye.co.za');
        $I->fillField('password', 'joshua');
        $I->fillField('password_confirmation', 'joshua');
        $I->click('register_user');
    }

    public function proceedToPayment()
    {
        $I = $this;

        $I->seeCurrentUrlEquals('/checkout/addresses');

        $I->fillInBillingAddress();

        $I->click('Add Address');

        $I->seeCurrentUrlEquals('/checkout/addresses/save');

        $userAddresses  = $I->addresses()->toArray();

        if (!empty($userAddresses)) {

            $lastAddedAddress = array_pop($userAddresses);

            $I->selectOption('billing', $lastAddedAddress['id']);
        }

        $I->click('Proceed to Payment');

        $I->seeCurrentUrlEquals('/checkout/payment');
    }

    public function addresses()
    {
        return Address::all();
    }

    public function products()
    {
        return Product::all();
    }
}