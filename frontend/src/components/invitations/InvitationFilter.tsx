import React, { FC } from 'react';
import { Filter, TextInput } from 'react-admin';
import { FilterProps } from '../../helper/AdminTypes';

interface InvitationFilterParams {
    recipientType: string;
    recipient: string;
}

const InvitationFilter: FC<FilterProps<InvitationFilterParams>> = (props) => (
    <Filter {...props}>
        <TextInput label='Recipient Type' source='recipientType' allowEmpty />
        <TextInput label='Recipient' source='recipient' allowEmpty />
    </Filter>
);

export default InvitationFilter;
