Feature:
    In order to create an account
    As an anomyous user
    I want to create an account

	Background: Common setup
		Then I add "Content-Type" header equal to "application/json"
		And I add "Accept" header equal to "application/json"

	Scenario: Create a new account
		When I send a "POST" request to "/api/users/create_account" with body:
		"""
		{
			"username" : "tester",
			"email"    : "test@test.com"
		}
		"""
        Then the response status code should be 204

        # And print last JSON response
        # And the header "Content-Type" should be equal to "application/json"
        # And the JSON nodes should contain:
		# 	| type   | user created                        | 
		# 	| title  | A confirmation email has been sent. | 
		# And the Json Node "errors" should have 0 element

	# Scenario: Login confirmed user
	# 	Given there is a common user "test@test.com" with password "drowssap"
	# 	When I send a "POST" request to "/api/login_check" with body:
	# 	"""
	# 	{
	# 		"email"    : "test@test.com",
	# 		"password" : "drowssap"
	# 	}
	# 	"""
	# 	Then the response status code should be 200
	# 	And the header "Content-Type" should be equal to "application/json"
    #     And the Json Node "token" should have 1 element
