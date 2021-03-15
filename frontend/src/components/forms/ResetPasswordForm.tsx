import { Notification, useRedirect, useNotify, required, email, SimpleForm, TextInput, SaveButton } from 'react-admin';
import React, { ReactElement, useState } from 'react';
import SiteDialog from '../misc/SiteDialog';
import Toolbar, { ToolbarProps } from '@material-ui/core/Toolbar';

const CustomToolbar = (props: ToolbarProps): ReactElement => (
    <Toolbar {...props}>
        <SaveButton submitOnEnter={true} fullWidth label='Reset Password' />
    </Toolbar>
);

const ResetPasswordForm = (): ReactElement => {
    const [isLoading, setIsLoading] = useState(false);

    const [emailInput, setEmailInput] = useState('');

    const redirect = useRedirect();

    const notify = useNotify();

    const errorMessage = 'Could not proccess your request.  Please try again later.';

    const successMessage = 'A reset password email has been sent';

    const handleSubmit = async (): Promise<void> => {
        if (isLoading === true) {
            return;
        }

        fetch(`/api/users/reset_password`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email: emailInput })
        })
            .then((response) => {
                if (!response.ok) {
                    console.log(response);

                    throw new Error(errorMessage);
                }

                notify(successMessage, 'info');
                setIsLoading(false);
                redirect('/');
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

                notify(message, 'error');
                setIsLoading(false);
            });
    };

    return (
        <SiteDialog title='Reset Password' width={300}>
            <>
                <SimpleForm redirect='/' onSubmit={handleSubmit} toolbar={<CustomToolbar />} submitOnEnter={true}>
                    <TextInput
                        source='email'
                        type='email'
                        value={emailInput}
                        validate={(required(), email())}
                        fullWidth
                        onChange={(e): void => setEmailInput(e.target.value)}
                    />
                    <>
                        I would like to <a href='/#/create_account'>create an account.</a> <br />
                        Already have an account? Sign in <a href='/#/login'>here.</a>
                    </>
                </SimpleForm>
                <Notification />
            </>
        </SiteDialog>
    );
};

export default ResetPasswordForm;
