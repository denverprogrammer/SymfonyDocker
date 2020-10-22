import {
    Notification,
    useLogin,
    useNotify,
    required,
    email,
    SimpleForm,
    TextInput,
    SaveButton,
    PasswordInput
} from 'react-admin';
import React, { ReactElement, useState } from 'react';
import SiteDialog from '../misc/SiteDialog';

const LoginForm = (): ReactElement => {
    const [isLoading, setIsLoading] = useState(false);

    const [emailInput, setEmailInput] = useState('');

    const [passwordInput, setPasswordInput] = useState('');

    const login = useLogin();

    const notify = useNotify();

    const handleSubmit = async (): Promise<void> => {
        if (isLoading === true) {
            return;
        }

        setIsLoading(true);
        login({ email: emailInput, password: passwordInput }, '/').catch((error) => {
            setIsLoading(false);
            let message = '';

            if (typeof error === 'string') {
                message = error;
            }

            if (typeof error === 'undefined' || !error.message) {
                message = 'ra.auth.sign_in_error';
            }

            if (message === '') {
                message = error.message;
            }

            notify(message, 'warning');
        });
    };

    return (
        <SiteDialog title='Log in' width={300}>
            <>
                <SimpleForm onSubmit={handleSubmit} toolbar={null} submitOnEnter={true}>
                    <TextInput
                        source='email'
                        type='email'
                        value={emailInput}
                        validate={(required(), email())}
                        fullWidth
                        onChange={(e): void => setEmailInput(e.target.value)}
                    />
                    <PasswordInput
                        source='password'
                        value={passwordInput}
                        validate={required()}
                        fullWidth
                        onChange={(e): void => setPasswordInput(e.target.value)}
                    />
                    <SaveButton
                        handleSubmitWithRedirect={handleSubmit}
                        submitOnEnter={true}
                        fullWidth
                        pristine={false}
                        saving={false}
                        disabled={isLoading}
                        label='Sign In'
                    />
                    <>
                        <br />I need to <a href='/#/reset_password'>reset my password.</a> <br />I would like to{' '}
                        <a href='/#/create_account'>create an account.</a>
                    </>
                </SimpleForm>
                <Notification />
            </>
        </SiteDialog>
    );
};

export default LoginForm;
