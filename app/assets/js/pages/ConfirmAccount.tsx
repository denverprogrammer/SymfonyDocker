import React, { useState } from 'react';
import { useHistory, useParams } from 'react-router-dom';
import Modal from '../components/Modal';
import PasswordInput from '../components/fields/PasswordInput';
import ApiService from '../helpers/ApiService';

export default function ConfirmAccount(): React.ReactElement {
    /**
     * User password.
     */
    const [password, setPassword] = useState<string>('');

    /**
     * Password confirmation.
     */
    const [confirmation, setConfirmation] = useState<string>('');

    /**
     * Reach router history.
     */
    const history = useHistory();

    /**
     * Reach router history.
     *
     * @var string User confirmation token.
     */
    const { token } = useParams();

    /**
     * Api.
     */
    const apiService = new ApiService();

    /**
     * Handle form submit.
     */
    const handleSubmit = async (event: React.FormEvent): Promise<void> => {
        event.preventDefault();

        if (confirmation || password === confirmation) {
            const response = await apiService.confirmUser(token, {
                password: password
            });

            console.log(response);

            if (response.status === 200) {
                history.push('/');
            }
        }
    };

    const handlePassword = (event: React.ChangeEvent<HTMLInputElement>): void => {
        setPassword(event.target.value);
    };

    const handleConfirmation = (event: React.ChangeEvent<HTMLInputElement>): void => {
        setConfirmation(event.target.value);
    };

    return (
        <div className="row d-flex justify-content-center">
            <div className="col-sm-8 col-md-6">
                <Modal title="Set Password">
                    <form onSubmit={handleSubmit}>
                        <PasswordInput
                            title="Create Password"
                            name="password"
                            value={password}
                            onChange={handlePassword}
                        />
                        <PasswordInput
                            title="Confirm Password"
                            name="confirmation"
                            value={confirmation}
                            onChange={handleConfirmation}
                        />
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
