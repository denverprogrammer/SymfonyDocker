import React, { FC } from 'react';
import { FieldProps } from '../../helper/AdminTypes';
import { User } from '../../helper/AppTypes';

const UserTitle: FC<FieldProps<User>> = ({ record }: FieldProps<User>) => (
    <span>User {record ? `"${record.username}"` : ''}</span>
);

export default UserTitle;
