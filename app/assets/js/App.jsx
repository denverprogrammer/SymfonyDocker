import React, { Component } from 'react';
import { BrowserRouter as Router, Route, Switch, Redirect, Link, withRouter } from 'react-router-dom';
import { render } from 'react-dom';
import '../css/app.css';

import Home from './components/Home';
import Users from './components/Users';
import Posts from './components/Posts';
import Login from './components/Login';
import Register from './components/Register';

class App extends Component {
    render() {
        return (
            <Router>
                <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                    <Link className="navbar-brand" to="/">Symfony Docker</Link>
                    <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#site-nav">
                        <span className="navbar-toggler-icon"></span>
                    </button>

                    <div className="collapse navbar-collapse" id="site-nav">
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item active">
                                <Link className="nav-link" to="/posts">Posts</Link>
                            </li>
                            <li className="nav-item active">
                                <Link className="nav-link" to="/users">Users</Link>
                            </li>
                            <li className="nav-item active">
                                <Link className="nav-link" to="/register">Register</Link>
                            </li>
                            <li className="nav-item active">
                                <Link className="nav-link" to="/login">Login</Link>
                            </li>
                        </ul>
                        <form className="form-inline my-2 my-lg-0">
                            <input className="form-control mr-sm-2" type="search" placeholder="Search" />
                            <button className="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
                <main role="container" className="container mt-3">
                    <Switch>
                        {/* <Redirect exact from="/" to="/users" /> */}
                        <Route path="/login" component={Login} />
                        <Route path="/register" component={Register} />
                        <Route path="/users" component={Users} />
                        <Route path="/posts" component={Posts} />
                        <Route path="/" component={Home} />
                    </Switch>
                </main>
            </Router>
        );
    }
}

export default App;

render(<App />, document.getElementById('root'));
