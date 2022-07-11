import React, {Component} from 'react';
import '../css/app.css';
import {Col, Container, Image, Nav, Navbar, Row} from "react-bootstrap";
import logo from "../assets/bookworm_icon.svg";

export class Footer extends Component {
    render() {
        return (
            <>
                <Navbar className={"bg-light"}>
                    <Container>
                        <Col md={2}>
                            <Image src={logo} alt={'logo bookworm'}/>
                        </Col>
                        <Col md={10}>
                            <Row>
                                <Navbar.Brand className={"p-0"} href="/">Bookworm</Navbar.Brand>
                            </Row>
                            <Row>
                                <Nav.Link className={"p-0"} href="/">Address: Ho Chi Minh City</Nav.Link>
                            </Row>
                            <Row>
                                <Nav.Link className={"p-0"} href="/">039.209.283</Nav.Link>
                            </Row>
                        </Col>
                    </Container>
                </Navbar>
            </>
        );
    }
}
