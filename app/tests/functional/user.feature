
# features/books.feature
Feature: Common Users feature
	@ClearDatabase
	Scenario: Register user
		When I add "Content-Type" header equal to "application/json"
		And I add "Accept" header equal to "application/json"
		And I send a "POST" request to "/register" with body:
		"""
		{
			"firstName" : "John",
			"lastName"  : "Doed",
			"email"     : "test@test.com",
			"password"  : "drowssap"
		}
		"""
		Then the response status code should be 201
		And the response should be in JSON
		And the header "Content-Type" should be equal to "application/json"
		And the JSON nodes should contain:
			| type   | user created                        | 
			| title  | A confirmation email has been sent. | 
		And the Json Node "errors" should have 0 element

	# Scenario: login user
	# 	Given there is a common user "test@test.com" with password "drowssap"
	# 	When I add "Content-Type" header equal to "application/json"
	# 	And I add "Accept" header equal to "application/json"
	# 	And I send a "POST" request to "/login" with body:
	# 	"""
	# 	{
	# 		"email"    : "test@test.com",
	# 		"password" : "drowssap",
	# 	}
	# 	"""
	# 	Then the response status code should be 200
	# 	And the response should be in JSON
	# 	And the header "Content-Type" should be equal to "application/json; charset=utf-8"
	# 	And the Json Node "token" should have 264 element

	# @UserLogin
	# Scenario: profile
	# 	When I add "Content-Type" header equal to "application/json"
	# 	And I add "Accept" header equal to "application/json"
	# 	And I send a "GET" request to "/profile"
	# 	Then the response status code should be 200
	# 	And the response should be in JSON
	# 	And the header "Content-Type" should be equal to "application/json; charset=utf-8"
	# 	And the JSON nodes should contain:
	# 		| firstName | Jon             | 
	# 		| lastName  | Doe             | 
	# 		| email     | test@test.com   | 
