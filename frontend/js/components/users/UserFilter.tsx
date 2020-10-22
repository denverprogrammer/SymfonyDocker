import React, { FC } from 'react';
import { Filter } from 'react-admin';
import { TextInput, EmailInput } from 'react-admin';
import { FilterProps } from '../../helper/AdminTypes';

interface UserFilterParams {
    username: string;
    email: string;
}

const UserFilter: FC<FilterProps<UserFilterParams>> = (props) => (
    <Filter {...props}>
        <TextInput label='Username' source='username' allowEmpty />
        <EmailInput label='Email' source='email' allowEmpty />
    </Filter>
);

export default UserFilter;
