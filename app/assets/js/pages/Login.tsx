import React, { useState, useEffect } from 'react';
import { useHistory } from 'react-router-dom';
import Modal from '../components/Modal';
import EmailInput from '../components/fields/EmailType';
import PasswordInput from '../components/fields/PasswordInput';
import SecuritySubject from '../helpers/SecuritySubject';

interface AuthenticationProps {
    security: SecuritySubject;
}

export default function Login({ security }: AuthenticationProps): React.ReactElement {
    /**
     * Email of user.
     */
    const [email, setEmail] = useState<string>('');

    /**
     * Password of user.
     */
    const [password, setPassword] = useState<string>('');

    /**
     * Reach router history.
     */
    const history = useHistory();

    const handleSetEmail = (event: React.ChangeEvent<HTMLInputElement>): void => {
        setEmail(event.target.value);
    };

    const handleSetPassword = (event: React.ChangeEvent<HTMLInputElement>): void => {
        setPassword(event.target.value);
    };

    /**
     * Handle form submit.
     */
    const handleSubmit = async (event: React.FormEvent): Promise<void> => {
        event.preventDefault();

        const response = await security.login({
            email: email,
            password: password
        });

        if (response.status === 200) {
            history.push('/');
        }
    };

    useEffect(() => {
        if (security.getItem()) {
            history.push('/');
        }
    }, []);

    return (
        <div className="row d-flex justify-content-center">
            <div className="col-sm-8 col-md-6">
                <Modal title="User Login">
                    <form onSubmit={handleSubmit}>
                        <EmailInput value={email} onChange={handleSetEmail} />
                        <PasswordInput value={password} onChange={handleSetPassword} />
                        <div className="d-flex justify-content-between">
                            <button type="submit" className="btn btn-primary">
                                Submit
                            </button>
                            <button type="button" className="btn btn-secondary">
                                Cancel
                            </button>
                        </div>
                    </form>
                </Modal>
            </div>
        </div>
    );
}
