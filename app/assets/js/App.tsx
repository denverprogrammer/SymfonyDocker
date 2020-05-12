import React, { ReactElement } from 'react';
import { BrowserRouter as Router, Route, Switch, Link } from 'react-router-dom';
import { render } from 'react-dom';
import '../css/app.css';

import Home from './components/Home';
import Login from './components/Login';
import Register from './components/Register';

function App(): ReactElement {
    return (
        <Router>
            <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                <Link className="navbar-brand" to="/">
                    Symfony Docker
                </Link>
                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#site-nav">
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="site-nav">
                    <ul className="navbar-nav mr-auto">
                        <li className="nav-item active">
                            <Link className="nav-link" to="/register">
                                Register
                            </Link>
                        </li>
                        <li className="nav-item active">
                            <Link className="nav-link" to="/login">
                                Login
                            </Link>
                        </li>
                    </ul>
                    <form className="form-inline">
                        <div className="input-group">
                            <input className="form-control" type="search" />
                            <div className="input-group-append">
                                <button className="btn btn-primary" type="submit">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </nav>
            <main role="container" className="container mt-3">
                <Switch>
                    <Route path="/login" component={Login} />
                    <Route path="/register" component={Register} />
                    <Route path="/" component={Home} />
                </Switch>
            </main>
        </Router>
    );
}

render(<App />, document.getElementById('root'));
