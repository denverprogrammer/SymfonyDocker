# Feature: Manage Usesr
#    In order to maintain users
#    As an admin
#    I need to be able to login to manage users.

# Scenario: List Users
#    Given there are 5 users
#    And I am logged in
#    When I request "/users"
#    Then I should see 5 users

# Scenario: Create User
#     Given user with a unique email
#     And I am logged in
#     When I post user details to "/users"
#     Then I get a valid user response with user details

# Scenario: Edit User
#     Given user with with "{id}"
#     And I am logged in
#     When I post changed details to "/users/{id}"
#     Then I get a valid user response with changed user details

# Scenario: View User Details
#     Given user with with "{id}"
#     And I am logged in
#     When I request "/users/{id}"
#     Then I user details "/users/{id}"

# features/books.feature
Feature: Users feature
  Scenario: Adding a new user
    Given there is an admin user "admin@test.com" with password "drowssap"
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/api/users" with body:
    """
    {
      "firstName" : "Jon",
      "lastName"  : "Doe",
      "email"     : "test@test.com",
      "roles"     : ["ROLE_USER"],
      "password"  : "drowssap"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON nodes should contain:
      | firstName | Jon           | 
      | lastName  | Doe           | 
      | email     | test@test.com | 
      | roles[0]  | ROLE_USER     | 
      | password  | drowssap      | 
    And the Json Node "roles" should have 1 element
