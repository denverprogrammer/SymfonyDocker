
# features/books.feature
Feature: Common Users feature

	Background: Common setup
		Given a clean database
		Given there is a common user 'test@test.com' with password 'drowssap'
		Given I log in as 'test@test.com'
		When I add 'Content-Type' header equal to 'application/json'
		And I add 'Accept' header equal to 'application/json'

	Scenario: View user profile
		When I send a 'GET' request to '/api/users/profile'
		Then the response status code should be 200
		And the response should be in JSON
		And the header 'Content-Type' should be equal to 'application/json'
		And the JSON nodes should contain:
			| firstName | Jon             | 
			| lastName  | Doe             | 
