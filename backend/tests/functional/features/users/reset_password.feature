Feature:
    In order to prove that the use the site
    As a user
    I want to reset my password

	Background: Common setup
		Then I add "Content-Type" header equal to "application/json"
		And I add "Accept" header equal to "application/json"

	Scenario: Reset password
		When I send a "POST" request to "/api/users/reset_password" with body:
		"""
		{
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
