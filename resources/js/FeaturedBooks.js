import React, {Component} from 'react';
import {Col, Container, Nav, Row, Tab} from "react-bootstrap";
import axios from "axios";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import RecommendBooks from "./Recommend";
import PopularBooks from "./Popular";

class FeaturedBooks extends Component {
    constructor(props) {
        super(props);

        this.state = {
            books: [],
        };
    }

    async componentDidMount() {
        let res = await axios.get("http://127.0.0.1:8000/api/books?recommend");
        this.setState({books: res ? res.data : []});
    }

    render() {
        const book = this.state.books;
        const settings = {
            dots: true,
            infinite: true,
            speed: 500,
            slidesToScroll: 1,
            slidesToShow: 4,
            adaptiveHeight: true,
            autoplay: true,

        };
        const linkViewALl = "/books?category=onsale";

        return (
            <section>
                <Container>
                    <Container fluid>
                        <Row className={"mt-5 text-center"}>
                            <h1>Featured Books</h1>
                        </Row>
                        <Row>

                            <Tab.Container defaultActiveKey={"recommend"}>
                                <Row>
                                    <Nav className={"justify-content-center"} variant={"pills"}>
                                        <Nav.Item>
                                            <Nav.Link eventKey={"recommend"}>Recommend</Nav.Link>
                                        </Nav.Item>
                                        <Nav.Item>
                                            <Nav.Link eventKey={"popular"}>Popular</Nav.Link>
                                        </Nav.Item>
                                    </Nav>
                                </Row>
                                <Row>
                                    <Tab.Content>
                                        <Tab.Pane eventKey="recommend">
                                            <Col className={"my-4 px-4 border"}>
                                                <RecommendBooks/>
                                            </Col>
                                        </Tab.Pane>
                                        <Tab.Pane eventKey="popular">
                                            <Col className={"my-4 px-4 border"}>
                                                <PopularBooks/>
                                            </Col>
                                        </Tab.Pane>
                                    </Tab.Content>
                                </Row>
                            </Tab.Container>
                        </Row>
                    </Container>
                </Container>
            </section>
        );
    }
}

export default FeaturedBooks;


