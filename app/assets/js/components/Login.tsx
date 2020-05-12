import React, {useState} from 'react';
import { useHistory } from "react-router-dom";
import axios from 'axios';
import Modal from './Modal';
import Email from '../fields/Email';
import Password from '../fields/Password';
import { AxiosResponse, AxiosError } from 'axios';

export default function Login() {

    const [email, setEmail] = useState('');

    const [password, setPassword] = useState('');

    const history = useHistory();

    const handleChange = (event: React.ChangeEvent<HTMLInputElement>): void => {
        switch(event.target.name) {
            case 'email':
                setEmail(event.target.value);
                break;
            case 'password':
                setPassword(event.target.value);
                break;
        }
    }

    const handleSubmit = (event: React.FormEvent): void => {
        const payload = {
            email: email,
            password: password
        };
        const $options = {
            headers: {
                'Accept': 'application/json; charset=utf-8',
                'Content-Type': 'application/json; charset=utf-8'
            }
        };

        axios.post(`/api/login_check`, JSON.stringify(payload), $options)
            .then((response): AxiosResponse => {
                if (response.status === 200) {
                    localStorage.setItem('authentication', response.data['token']);
                    history.push('/');
                }

                console.log(response);

                return response.data;
            })
            .catch((reason: AxiosError) => {
                console.log(reason.toJSON());
            });

        event.preventDefault();
    }

    return(
        <div className="row d-flex justify-content-center">
            <div className="col-sm-8 col-md-6">
                <Modal title="User Login">
                    <form onSubmit={handleSubmit}>
                        <Email value={email} onChange={handleChange} />
                        <Password value={password} onChange={handleChange} />
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
