<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am a Guest User
     */
    public function iAmAGuestUser()
    {
        return true;
    }


    /**
     * @Given I am in the :arg1 path
     */
    public function iAmInThePath($arg1)
    {
       
    }

    /**
     * @When I fill in my email address
     */
    public function iFillInMyEmailAddress()
    {
        throw new PendingException();
    }

    /**
     * @When L fill in my password
     */
    public function lFillInMyPassword()
    {
        throw new PendingException();
    }

    /**
     * @When L fill in the password confirmation
     */
    public function lFillInThePasswordConfirmation()
    {
        throw new PendingException();
    }

    /**
     * @When I click the register_user button
     */
    public function iClickTheRegisterUserButton()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1)
    {
        throw new PendingException();
    }
}
