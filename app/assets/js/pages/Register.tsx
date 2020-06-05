import React, { useState, useEffect } from 'react';
import { useHistory } from 'react-router-dom';
import Modal from '../components/Modal';
import Email from '../components/fields/Email';
import TextInput from '../components/fields/TextInput';
import ApiService from '../helpers/ApiService';
import SecuritySubject from '../helpers/SecuritySubject';

interface AuthenticationProps {
    security: SecuritySubject;
}

export default function Register({ security }: AuthenticationProps): React.ReactElement {
    /**
     * First name of user.
     */
    const [firstName, setFirstName] = useState<string>('');

    /**
     * Last name of user.
     */
    const [lastName, setLastName] = useState<string>('');

    /**
     * Email of user.
     */
    const [email, setEmail] = useState<string>('');

    /**
     * Reach router history.
     */
    const history = useHistory();

    /**
     * Api.
     */
    const apiService = new ApiService();

    useEffect(() => {
        if (security.getItem()) {
            history.push('/');
        }
    }, []);

    /**
     * Handle form submit.
     */
    const handleSubmit = async (event: React.FormEvent): Promise<void> => {
        event.preventDefault();

        const response = await apiService.register({
            firstName: firstName,
            lastName: lastName,
            email: email
        });

        console.log(response);

        if (response.status === 201) {
            history.push('/');
        }
    };

    const handleSetFirstName = (event: React.ChangeEvent<HTMLInputElement>): void => {
        setFirstName(event.target.value);
    };

    const handleSetLastName = (event: React.ChangeEvent<HTMLInputElement>): void => {
        setLastName(event.target.value);
    };

    const handleSetEmail = (event: React.ChangeEvent<HTMLInputElement>): void => {
        setEmail(event.target.value);
    };

    return (
        <div className='row d-flex justify-content-center'>
            <div className='col-sm-8 col-md-6'>
                <Modal title='Register User'>
                    <form onSubmit={handleSubmit}>
                        <TextInput
                            title='First Name'
                            name='firstName'
                            value={firstName}
                            onChange={handleSetFirstName}
                        />
                        <TextInput title='Last Name' name='lastName' value={lastName} onChange={handleSetLastName} />
                        <Email value={email} onChange={handleSetEmail} />
                        <div className='d-flex justify-content-between'>
                            <button type='submit' className='btn btn-primary'>
                                Submit
                            </button>
                            <button type='button' className='btn btn-secondary'>
                                Cancel
                            </button>
                        </div>
                    </form>
                </Modal>
            </div>
        </div>
    );
}
