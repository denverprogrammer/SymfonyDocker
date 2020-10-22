import React, { ReactElement } from 'react';
import { Redirect, Route } from 'react-router-dom';
import { hydraDataProvider as baseHydraDataProvider, fetchHydra as baseFetchHydra } from '@api-platform/admin';
import parseHydraDocumentation from '@api-platform/api-doc-parser/lib/hydra/parseHydraDocumentation';

interface HydraProperties {
    url: string;
    options: {};
}

// const entrypoint = process.env.REACT_APP_API_ENTRYPOINT;
const entrypoint = '/api';
const fetchHeaders = { credentials: 'include' };
const fetchHydra = (url, options = {}): HydraProperties =>
    baseFetchHydra(url, {
        ...options,
        headers: new Headers(fetchHeaders)
    });

const apiDocumentationParser = (entrypoint: any): Promise<any> => {
    console.log(['entrypoint', entrypoint]);
    return parseHydraDocumentation(entrypoint, { headers: new Headers(fetchHeaders) }).then(
        ({ api }) => ({ api }),
        (result) => {
            console.log(['entrypoint', entrypoint, 'result', result]);
            switch (result.status) {
                case 401:
                    return Promise.resolve({
                        api: result.api,
                        customRoutes: [
                            // <Route
                            // key='root'
                            // path='/'
                            // render={() => {
                            //     return window.localStorage.getItem('username') ? (
                            //         window.location.reload()
                            //     ) : (
                            //         <Redirect to='/login' />
                            //     );
                            // }}
                            // />
                        ]
                    });

                default:
                    return Promise.reject(result);
            }
        }
    );
};

const dataProvider = baseHydraDataProvider(entrypoint, fetchHydra, apiDocumentationParser);

dataProvider.introspect();

export default dataProvider;
