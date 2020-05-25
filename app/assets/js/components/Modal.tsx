import React from 'react';

interface ModalTypes {
    title: string;

    children: React.ReactElement;
}

export default function Modal({ title, children }: ModalTypes): React.ReactElement {
    return (
        <div className='card'>
            <div className='card-header d-flex justify-content-center'>
                <h4>{title}</h4>
            </div>
            <div className='card-body'>{children}</div>
        </div>
    );
}
