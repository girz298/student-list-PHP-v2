Feature: AddStudent
  @javascript
  Scenario: Adding a student from main-page
    Given I am on "/"
    When I fill in "name" with "John"
    When I fill in "surname" with "Doe"
    When I fill in "group" with "232640"
    When I fill in "score" with "240"
    When I fill in "email" with "mail@gmail.com"
    And I press "submit"
    Then I should see "John"
  @javascript
  Scenario:  Deleting all students from main-page
    Given I am on "/"
    And I should see "John"
    Then I am on "?action=delete"
    And I should not see "John"
    And I should not see "Doe"