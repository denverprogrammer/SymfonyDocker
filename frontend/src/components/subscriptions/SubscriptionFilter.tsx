import React, { FC } from 'react';
import { Filter } from 'react-admin';
import { TextInput } from 'react-admin';
import { FilterProps } from '../../helper/AdminTypes';
import { UserType } from '../../helper/AppTypes';

interface SubscriptionFilterParams {
    userType?: UserType;
}

const SubscriptionFilter: FC<FilterProps<SubscriptionFilterParams>> = (props) => (
    <Filter {...props}>
        <TextInput label='User Type' source='userType' allowEmpty />
    </Filter>
);

export default SubscriptionFilter;
