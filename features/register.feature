Feature: User Registration
  In order to register as a Site User
  As a Guest User
  I need to be able to use my credentials to register as a site use

  Scenario: Register as a Site User
    Given I am a Guest User
    And I am in the "user/register" path
    When I fill in my email address
    And L fill in my password
    And L fill in the password confirmation
    And I click the register_user button
    Then I should see "Dashbord"