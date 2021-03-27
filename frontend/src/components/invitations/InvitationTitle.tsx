import React, { FC } from 'react';
import { FieldProps } from '../../helper/AdminTypes';
import { Invitation } from '../../helper/AppTypes';

const InvitationTitle: FC<FieldProps<Invitation>> = ({ record }: FieldProps<Invitation>) => (
    <span>Invitation for {record ? `"${record.recipient}"` : ''}</span>
);

export default InvitationTitle;
