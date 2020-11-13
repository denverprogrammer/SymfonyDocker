interface UserLoginProps {
    email: string;
    password: string;
}

export default {
    // called when the user attempts to log in
    login: ({ email, password }: UserLoginProps): Promise<void> => {
        const request = new Request('/api/login', {
            method: 'POST',
            body: JSON.stringify({
                email: email,
                password: password
            }),
            headers: new Headers({ 'Content-Type': 'application/json' })
        });

        return fetch(request)
            .then((response) => {
                if (response.status < 200 || response.status >= 300) {
                    throw new Error(response.statusText);
                }

                return response.json();
            })
            .then(({ username }) => {
                localStorage.setItem('username', username);
            });
    },

    // called when the user clicks on the logout button
    logout: (): Promise<void> => {
        localStorage.removeItem('username');

        return Promise.resolve();
    },

    // called when the API returns an error
    checkError: (error): Promise<void> => {
        const status = error.status;

        if (status === 401 || status === 403) {
            localStorage.removeItem('username');

            return Promise.reject();
        }

        return Promise.resolve();
    },

    // called when the user navigates to a new location, to check for authentication
    checkAuth: (): Promise<void> => {
        return localStorage.getItem('username') ? Promise.resolve() : Promise.reject({ redirectTo: '/login' });
    },

    // called when the user navigates to a new location, to check for permissions / roles
    getPermissions: (): Promise<void> => Promise.resolve()
};
