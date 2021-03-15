import {
    Notification,
    useNotify,
    useRedirect,
    required,
    SimpleForm,
    PasswordInput,
    BooleanInput,
    SaveButton
} from 'react-admin';
import React, { ReactElement, useState } from 'react';
import SiteDialog from '../misc/SiteDialog';
import Toolbar, { ToolbarProps } from '@material-ui/core/Toolbar';

interface ConfirmAccountProps {
    token: string;
}

interface ValidationProps {
    newPassword: string | null;
    confirmPassword: string | null;
}

const CustomToolbar = (props: ToolbarProps): ReactElement => (
    <Toolbar {...props}>
        <SaveButton submitOnEnter={true} fullWidth label='Confirm Account' />
    </Toolbar>
);

const ConfirmAccountForm = ({ token }: ConfirmAccountProps): ReactElement => {
    const [isLoading, setIsLoading] = useState(false);

    const [confirmInput, setConfirmInput] = useState('');

    const [passwordInput, setPasswordInput] = useState('');

    const [notificationsInput, setNotificationsInput] = useState(true);

    const [agreementInput, setAgreementInput] = useState(false);

    const redirect = useRedirect();

    const notify = useNotify();

    const errorMessage = 'Sorry but your account could not be confirmed.';

    const successMessage = 'Your account has been confirmed.  Please login using your email.';

    const handleSubmit = async (): Promise<void> => {
        if (isLoading === true) {
            return;
        }

        fetch(`/api/users/confirm_account/${token}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                password: passwordInput,
                notifications: notificationsInput,
                agreement: agreementInput
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

    const notificationsText = notificationsInput ? 'Send me notifications.' : 'Do not send me notifications.';

    const agreementText = agreementInput
        ? 'I agree to the the Terms of Service.'
        : 'I do not agree to the terms of service.';

    return (
        <SiteDialog title='Confirm Account' width={300}>
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
                    <BooleanInput
                        source='notifications'
                        fullWidth
                        label={notificationsText}
                        defaultValue={notificationsInput}
                        onChange={(e): void => setNotificationsInput(e === true)}
                    />
                    <BooleanInput
                        source='agreement'
                        validate={required()}
                        fullWidth
                        label={agreementText}
                        defaultValue={agreementInput}
                        onChange={(e): void => setAgreementInput(e === true)}
                    />
                </SimpleForm>
                <Notification />
            </>
        </SiteDialog>
    );
};

export default ConfirmAccountForm;
