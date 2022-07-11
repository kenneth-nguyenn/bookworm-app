import React, {Component} from 'react';
import {Col, Container, Row} from "react-bootstrap";

class AboutPage extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <main>
                <Container fluid>
                    <Row className={"border-bottom"}>
                        <h6 style={{"font-weight": "bold"}}>About Us</h6>
                    </Row>
                    <Row>
                        <Col className={"mx-3"}>
                            <Row className={"my-2"}>
                                <h1 style={{"font-weight": "bold", "text-align": "center"}} className={"my-3"}>Welcome
                                    to Bookworm</h1>
                                <p>"Bookworm is an independent New York bookstore and language school with location in
                                    Manhattan and Brooklyn. We specialize in travel books and language classes."</p>
                            </Row>
                            <Row>
                                <Col className={"my-2"}>
                                    <h2 style={{"font-weight": "bold"}}>Our Story</h2>
                                    <p>The name Bookworm was taken from the original name for New York International
                                        Airport, which was renamed JFK in December 1963.</p>
                                    <p>Our Manhanttan store has just moved to the West Village. Our new location is 170
                                        7th Avenue South, at the cornner of Perrt Street.</p>
                                    <p>From March 2008 through May 2016, the store was located in the Flatiron
                                        District.</p>
                                </Col>
                                <Col className={"my-2"}>
                                    <h2 style={{"font-weight": "bold"}}>Our Vision</h2>
                                    <p>One of the last travel bookstores in the country, our Manhattan store carries a
                                        range of guidebooks (all 10% off) to suit the needs and tastes of every traveler
                                        and budget.</p>
                                    <p>We believe that a novel or travelogue can be just as valuable a key to a place as
                                        any guidenook, and our well-read, well-traveled staff is happy to make reading
                                        recommendations for any traveler, book lover, or gift giver.</p>
                                </Col>
                            </Row>
                        </Col>
                    </Row>
                </Container>
            </main>
        );
    }
}

export default AboutPage;
