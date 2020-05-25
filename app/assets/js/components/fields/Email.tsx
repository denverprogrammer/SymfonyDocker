import React from 'react';
import InputTypes from './InputTypes';

export default function Email({
    title = 'Email',
    name = 'email',
    value = '',
    onChange
}: InputTypes): React.ReactElement {
    return (
        <div className='form-group'>
            <label htmlFor={`id_${name}`}>{title}</label>
            <input
                id={`id_${name}`}
                name={name}
                type='email'
                className='form-control'
                value={value}
                onChange={onChange}
            />
        </div>
    );
}
