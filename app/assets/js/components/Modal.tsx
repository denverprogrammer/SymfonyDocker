import React, { ReactElement } from 'react';

interface ModalTypes {
    title: string;

    children: ReactElement;
}

export default function Modal({title, children}: ModalTypes) {
    return (
        <div className="card">
            <div className="card-header d-flex justify-content-center">
                <h4>{title}</h4>
            </div>
            <div className="card-body">
                {children}
            </div>
        </div>
    );
}
