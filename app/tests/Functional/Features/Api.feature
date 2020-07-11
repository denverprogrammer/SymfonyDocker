# Scenario: List Users
#    Given there are 5 users
#    And I am logged in
#    When I request '/users'
#    Then I should see 5 users

Feature: Manage Usesr
   In order to maintain users
   As an admin
   I need to be able to login to manage users.

	Background: Common setup
		Given a clean database
		Given there is a admin user 'admin@test.com' with password 'drowssap'
		Given I log in as 'admin@test.com'
		When I add 'Content-Type' header equal to 'application/json'
		And I add 'Accept' header equal to 'application/json'

	Scenario: Adding a new user
		When I send a 'POST' request to '/api/users' with body:
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
		And the header 'Content-Type' should be equal to 'application/json; charset=utf-8'
		And the JSON nodes should contain:
			| firstName | Jon            | 
			| lastName  | Doe            | 
			| email     | test@test.com  | 
			| roles[0]  | ROLE_USER      | 
		And the Json Node 'roles' should have 1 element

	Scenario: Adding a new user who is already present
		Given there is a common user 'test@test.com' with password 'drowssap'
		When I send a 'POST' request to '/api/users' with body:
		"""
		{
			"firstName" : "Jon",
			"lastName"  : "Doe",
			"email"     : "test@test.com",
			"roles"     : ["ROLE_USER"],
			"password"  : "drowssap"
		}
		"""
		Then the response status code should be 400
		And the response should be in JSON
		And the header 'Content-Type' should be equal to 'application/problem+json; charset=utf-8'
		And the JSON Node 'detail' should contain 'email: This value is already used.'
		And the JSON Node 'title' should contain 'An error occurred'

	Scenario: Requesting user details
		Given there is a common user 'test@test.com' with password 'drowssap'
		When I send a 'GET' request to '/api/users/2'
		Then the response status code should be 200
		And the response should be in JSON
		And the header 'Content-Type' should be equal to 'application/json; charset=utf-8'
		And the JSON nodes should contain:
			| id        | 2               | 
			| firstName | Jon             | 
			| lastName  | Doe             | 
			| email     | test@test.com   | 
			| roles[0]  | ROLE_USER       | 
		And the Json Node 'roles' should have 1 element

	Scenario: Requesting user details for a non existant user
		When I send a 'GET' request to '/api/users/1234'
		Then the response status code should be 404
		And the response should be in JSON
		And the header 'Content-Type' should be equal to 'application/problem+json; charset=utf-8'
		And the JSON Node 'detail' should contain 'Not Found'
		And the JSON Node 'title' should contain 'An error occurred'

	Scenario: Editing a common user
		Given there is a common user 'test@test.com' with password 'drowssap'
		When I send a 'PUT' request to '/api/users/1' with body:
		"""
		{
			"firstName" : "Jon edited",
			"lastName"  : "Doe edited",
			"email"     : "common.edited@test.com",
			"roles"     : ["ROLE_USER"]
		}
		"""
		Then the response status code should be 200
		And the response should be in JSON
		And the header 'Content-Type' should be equal to 'application/json; charset=utf-8'
		And the JSON nodes should contain:
			| id        | 1                      | 
			| firstName | Jon edited             | 
			| lastName  | Doe edited             | 
			| email     | common.edited@test.com | 
			| roles[0]  | ROLE_USER              | 
