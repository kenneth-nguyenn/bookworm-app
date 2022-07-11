import React, {Component} from 'react';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import OnSale from "../OnSale";
import FeaturedBooks from "../FeaturedBooks";
import {Container, Row} from "react-bootstrap";

class Homepage extends Component {
    render() {
        return (
            <main>
                <Container fluid>
                    <Row>
                        <OnSale/>
                    </Row>
                    <Row>
                        <FeaturedBooks/>
                    </Row>
                </Container>
            </main>
        );
    }
}

export default Homepage;


