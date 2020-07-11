
# features/books.feature
Feature: Common Users feature

	Background: Common setup
		Given a clean database
		Then I add 'Content-Type' header equal to 'application/json'
		And I add 'Accept' header equal to 'application/json'

	Scenario: Register new user
		When I send a 'POST' request to '/create_account' with body:
		"""
		{
			"firstName" : "Jon",
			"lastName"  : "Doe",
			"email"     : "test@test.com"
		}
		"""
		Then the response status code should be 201
		And the response should be in JSON
		And the header 'Content-Type' should be equal to 'application/json'
		And the JSON nodes should contain:
			| type   | user created                        | 
			| title  | A confirmation email has been sent. | 
		And the Json Node 'errors' should have 0 element

	Scenario: Login confirmed user
		Given there is a common user 'test@test.com' with password 'drowssap'
		When I send a 'POST' request to '/api/login_check' with body:
		"""
		{
			"email"    : "test@test.com",
			"password" : "drowssap"
		}
		"""
		Then the response status code should be 200
		And the response should be in JSON
		And the header 'Content-Type' should be equal to 'application/json'
		And the Json Node 'token' should have 1 element
