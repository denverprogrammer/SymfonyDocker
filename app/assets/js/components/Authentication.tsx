import React, { useState, useEffect } from 'react';
import { Link, useHistory } from 'react-router-dom';
import SecuritySubject, { UserObserver } from '../helpers/SecuritySubject';
import User from '../models/User';

interface AuthenticationProps {
    security: SecuritySubject;
}

export default function Authentication({ security }: AuthenticationProps): React.ReactElement {
    /**
     * React router history.
     */
    const history = useHistory();

    /**
     * Current user.
     */
    const [user, setUser] = useState<User | null>(null);

    const updateUser: UserObserver = (item: User | null): void => {
        setUser(item);
    };

    const logoutClick = (event: React.MouseEvent<HTMLAnchorElement>): void => {
        event.preventDefault();
        security.logout();
        history.push('/');
    };

    useEffect(() => {
        security.attach(updateUser);
        security.updateObservers();

        return (): void => security.detach(updateUser);
    }, []);

    return (
        <div>
            {user ? (
                <span>{`Hello ${user.firstName} ${user.lastName}`}</span>
            ) : (
                <Link className='btn btn-link' to='/register'>
                    Register
                </Link>
            )}

            {user ? (
                <Link className='btn btn-link' to='/logout' onClick={logoutClick}>
                    Logout
                </Link>
            ) : (
                <Link className='btn btn-link' to='/login'>
                    Login
                </Link>
            )}
        </div>
    );
}
