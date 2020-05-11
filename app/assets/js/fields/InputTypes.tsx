import React from 'react';

export default interface InputTypes {
    title?: string;

    value?: string;

    name?: string;

    onChange?: React.ChangeEventHandler;
}
