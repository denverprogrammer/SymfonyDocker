import React, { useState } from 'react';
import { useHistory } from 'react-router-dom';
import axios from 'axios';
import Modal from './Modal';
import Email from '../fields/Email';
import Password from '../fields/Password';
import TextInput from '../fields/TextInput';
import { AxiosResponse, AxiosError } from 'axios';

export default function Register() {

    const [firstName, setFirstName] = useState('');

    const [lastName, setLastName] = useState('');

    const [email, setEmail] = useState('');

    const [password, setPassword] = useState('');

    const [confirm, setConfirm] = useState('');

    const history = useHistory();

    const handleChange = (event: React.ChangeEvent<HTMLInputElement>): void => {
        switch(event.target.name) {
            case 'firstName':
                setFirstName(event.target.value);
                break;
            case 'lastName':
                setLastName(event.target.value);
                break;
            case 'email':
                setEmail(event.target.value);
                break;
            case 'password':
                setPassword(event.target.value);
                break;
            case 'confirm':
                setConfirm(event.target.value);
                break;
        }

        event.preventDefault();
    };

    const handleSubmit = (event: React.FormEvent): void => {
        const payload = {
            firstName: firstName,
            lastName: lastName,
            email: email,
            password: password
        };
        const $options = {
            headers: {
                'Accept': 'application/json; charset=utf-8',
                'Content-Type': 'application/json; charset=utf-8'
            }
        };

        axios.post(`/auth/register`, JSON.stringify(payload), $options)
            .then((response): AxiosResponse => {
                if (response.status === 201) {
                    history.push('/');
                }

                console.log(response);

                return response.data;
            })
            .catch((reason: AxiosError) => {
                console.log(reason.toJSON());
            });

        event.preventDefault();
    };

    return(
        <div className="row d-flex justify-content-center">
            <div className="col-sm-8 col-md-6">
                <Modal title="Register User">
                    <form onSubmit={handleSubmit}>
                        <TextInput title="First Name" name="firstName" value={firstName} onChange={handleChange} />
                        <TextInput title="Last Name" name="lastName" value={lastName} onChange={handleChange} />
                        <Email value={email} onChange={handleChange} />
                        <Password value={password} onChange={handleChange} />
                        <Password title="Confirm Password" name="confirm" value={confirm} onChange={handleChange} />
                        <div className="d-flex justify-content-between">
                            <button type="submit" className="btn btn-primary">Submit</button>
                            <button type="button" className="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </Modal>
            </div>
        </div>
    )
}
