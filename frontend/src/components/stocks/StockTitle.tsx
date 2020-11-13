import React, { FC } from 'react';
import { FieldProps } from '../../helper/AdminTypes';
import { Stock } from '../../helper/AppTypes';

const StockTitle: FC<FieldProps<Stock>> = ({ record }: FieldProps<Stock>) => (
    <span>Stock {record ? `"${record.title}"` : ''}</span>
);

export default StockTitle;
