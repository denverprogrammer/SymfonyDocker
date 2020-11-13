import {
    Notification,
    useRedirect,
    useNotify,
    useDataProvider,
    required,
    email,
    SimpleForm,
    TextInput,
    SaveButton
} from 'react-admin';
import React, { ReactElement, useState } from 'react';
import SiteDialog from '../misc/SiteDialog';

const CreateAccountForm = (): ReactElement => {
    const [isLoading, setIsLoading] = useState(false);

    const [emailInput, setEmailInput] = useState('');

    const [usernameInput, setUsernameInput] = useState('');

    const redirect = useRedirect();

    const dataProvider = useDataProvider();

    const notify = useNotify();

    const errorMessage = 'Could not create account.  Please try again later.';

    const successMessage = 'Please check for a confirmation email.';

    const handleSubmit = async (): Promise<void> => {
        if (isLoading === true) {
            return;
        }

        fetch(`/api/users/create_account`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: emailInput,
                username: usernameInput
            })
        })
            .then((response) => {
                if (!response.ok) {
                    console.log(response);

                    throw new Error(errorMessage);
                }

                notify(successMessage, 'info');
                setIsLoading(false);
                redirect('/login');
            })
            .catch((error) => {
                let message = '';

                if (typeof error === 'string') {
                    message = error;
                }

                if (typeof error === 'undefined' || !error.message) {
                    message = errorMessage;
                }

                if (message === '') {
                    message = error.message;
                }

                notify(message, 'warning');
                setIsLoading(false);
            });
    };

    return (
        <SiteDialog title='Create Account' width={300}>
            <>
                <SimpleForm onSubmit={handleSubmit} toolbar={null} submitOnEnter={true}>
                    <TextInput
                        source='username'
                        value={usernameInput}
                        validate={required()}
                        fullWidth
                        onChange={(e): void => setUsernameInput(e.target.value)}
                    />
                    <TextInput
                        source='email'
                        type='email'
                        value={emailInput}
                        validate={(required(), email())}
                        fullWidth
                        onChange={(e): void => setEmailInput(e.target.value)}
                    />
                    <SaveButton
                        handleSubmitWithRedirect={handleSubmit}
                        submitOnEnter={true}
                        fullWidth
                        pristine={false}
                        saving={false}
                        disabled={isLoading}
                        label='Create Account'
                    />
                    <>
                        <br />I need to <a href='/#/reset_password'>reset my password.</a> <br />
                        Already have an account? Login <a href='/#/login'>here.</a>
                    </>
                </SimpleForm>
                <Notification />
            </>
        </SiteDialog>
    );
};

export default CreateAccountForm;
