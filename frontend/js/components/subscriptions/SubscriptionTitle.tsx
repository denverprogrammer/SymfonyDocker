import React, { FC } from 'react';
import { FieldProps } from '../../helper/AdminTypes';
import { Subscription } from '../../helper/AppTypes';

const SubscriptionTitle: FC<FieldProps<Subscription>> = ({ record }: FieldProps<Subscription>) => (
    <span>Subscription {record ? `"${record.userType}"` : ''}</span>
);

export default SubscriptionTitle;
