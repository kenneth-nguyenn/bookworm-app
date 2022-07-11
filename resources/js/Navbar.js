import React, {Component} from 'react';
import {Container, Image, Nav, Navbar} from "react-bootstrap";
import logo from "../assets/bookworm_icon.svg";

export class Navigabar extends Component {
    render() {
        return (
            <>
                <Navbar className="navbar navbar-light bg-light sticky-top">
                    <Container fluid>
                        <Image src={logo} alt={'logo bookworm'}/>
                        <Nav className="mx-2">
                            <Nav.Link href="/">Home</Nav.Link>
                            <Nav.Link href="/shop">Shop</Nav.Link>
                            <Nav.Link href="/about">About</Nav.Link>
                            <Nav.Link href="/cart">Cart</Nav.Link>
                            <Nav.Link href="/login">Sign In</Nav.Link>

                            {/*<Navbar.Toggle />*/}
                            {/*<Navbar.Collapse className="justify-content-end">*/}
                            {/*    <Navbar.Text>*/}
                            {/*        Signed in as: <a href="/user">Mark Otto</a>*/}
                            {/*    </Navbar.Text>*/}
                            {/*</Navbar.Collapse>*/}
                        </Nav>
                    </Container>
                </Navbar>
            </>
        );
    }
}
