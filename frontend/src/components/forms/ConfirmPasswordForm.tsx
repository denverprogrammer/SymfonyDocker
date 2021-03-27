import { Notification, useRedirect, useNotify, required, SimpleForm, PasswordInput, SaveButton } from 'react-admin';
import React, { ReactElement, useState } from 'react';
import SiteDialog from '../misc/SiteDialog';
import Toolbar, { ToolbarProps } from '@material-ui/core/Toolbar';

interface ConfirmPasswordProps {
    token: string;
}

interface ValidationProps {
    newPassword: string | null;
    confirmPassword: string | null;
}

const CustomToolbar = (props: ToolbarProps): ReactElement => (
    <Toolbar {...props}>
        <SaveButton submitOnEnter={true} fullWidth label='Confirm Password' />
    </Toolbar>
);

const ConfirmPasswordForm = ({ token }: ConfirmPasswordProps): ReactElement => {
    const [isLoading, setIsLoading] = useState(false);

    const [passwordInput, setPasswordInput] = useState('');

    const [confirmInput, setConfirmInput] = useState('');

    const redirect = useRedirect();

    const notify = useNotify();

    const errorMessage = 'Sorry but your request could not be processed.  Please try again later.';

    const successMessage = 'Your password has been reset.  Please login using your email.';

    const handleSubmit = async (): Promise<void> => {
        if (isLoading === true) {
            return;
        }

        fetch(`/api/users/confirm_password/${token}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ password: passwordInput })
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

                notify(message, 'error');
                setIsLoading(false);
            });
    };

    const validateInput = ({ newPassword, confirmPassword }: ValidationProps): unknown => {
        const errors = {
            newPassword: Array<string>(),
            confirmPassword: Array<string>()
        };

        setIsLoading(false);
        if (confirmPassword != newPassword) {
            errors.confirmPassword.push('New password and confirmation password must match.');
            setIsLoading(true);
        }

        return errors;
    };

    return (
        <SiteDialog title='Confirm Password' width={300}>
            <>
                <SimpleForm
                    validate={validateInput}
                    onSubmit={handleSubmit}
                    toolbar={<CustomToolbar />}
                    submitOnEnter={true}
                >
                    <PasswordInput
                        source='newPassword'
                        value={passwordInput}
                        validate={required()}
                        fullWidth
                        onChange={(e): void => setPasswordInput(e.target.value)}
                    />
                    <PasswordInput
                        source='confirmPassword'
                        value={confirmInput}
                        validate={required()}
                        fullWidth
                        onChange={(e): void => setConfirmInput(e.target.value)}
                    />
                </SimpleForm>
                <Notification />
            </>
        </SiteDialog>
    );
};

export default ConfirmPasswordForm;
