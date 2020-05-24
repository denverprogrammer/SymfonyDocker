import '../css/app.css';
import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Route, Switch, Link } from 'react-router-dom';
import { render } from 'react-dom';

import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import Authentication from './components/Authentication';
import SearchInput from './components/fields/SearchInput';
import SecuritySubject from './helpers/SecuritySubject';

function App(): React.ReactElement {
    /**
     * Search value.
     */
    const [search, setSearch] = useState<string>('');

    /**
     * Security subject.
     */
    const [security] = useState<SecuritySubject>(new SecuritySubject());

    const handleSetSearch = (event: React.ChangeEvent<HTMLInputElement>): void => {
        setSearch(event.target.value);
    };

    useEffect(() => {
        security.updateObservers();
    }, []);

    return (
        <Router>
            <nav className='navbar navbar-expand-lg navbar-dark bg-dark'>
                <Link className='navbar-brand' to='/'>
                    Symfony Docker
                </Link>
                <button className='navbar-toggler' type='button' data-toggle='collapse' data-target='#site-nav'>
                    <span className='navbar-toggler-icon'></span>
                </button>

                <div className='collapse navbar-collapse' id='site-nav'>
                    {/* <ul className='navbar-nav mr-auto'>
                        <li className='nav-item active'>
                            <Link className='nav-link' to='/register'>
                                Register
                            </Link>
                        </li>
                        <li className='nav-item active'>
                            <Link className='nav-link' to='/login'>
                                Login
                            </Link>
                        </li>
                    </ul> */}
                    <form className='form-inline ml-auto'>
                        <SearchInput value={search} onChange={handleSetSearch} />
                    </form>
                </div>
            </nav>
            <div className='d-flex justify-content-end mr-3'>
                <Authentication security={security} />
            </div>
            <main role='container' className='container mt-3'>
                <Switch>
                    <Route path='/login' render={(): React.ReactElement => <Login security={security} />} />
                    <Route path='/register' render={(): React.ReactElement => <Register security={security} />} />
                    <Route exact path='/' component={Home} />
                </Switch>
            </main>
        </Router>
    );
}

render(<App />, document.getElementById('root'));
