import React, {Component} from 'react';
import {Button, Col, Container, Row} from "react-bootstrap";
import axios from "axios";
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import SingleCard from "./SingleCard";
import * as Icon from 'react-bootstrap-icons';

class OnSale extends Component {
    constructor(props) {
        super(props);

        this.state = {
            books: [],
        };
    }

    async componentDidMount() {
        let res = await axios.get("http://127.0.0.1:8000/api/books?onsales");
        this.setState({books: res ? res.data : []});
    }

    render() {
        const book = this.state.books;
        const linkViewALl = "/shop";
        const settings = {
            dots: true,
            infinite: true,
            speed: 500,
            slidesToScroll: 3,
            slidesToShow: 4,
            autoplay: true,
        };
        return (
            <>
                <section>
                    <Container>
                        <Container fluid>
                            <Container fluid>
                                <Row className={"align-self-center"}>
                                    <Col md={10}>
                                        <h1>On Sale</h1>
                                    </Col>
                                    <Col md={2} className={"d-grid gap-2 align-self-center"}>
                                        <Button className={"primary"}
                                                href={linkViewALl}>
                                            View All
                                            <Icon.CaretRightFill/>
                                        </Button>
                                    </Col>
                                </Row>
                            </Container>
                            <Container fluid>
                                <Col className={"p-4 border"}>
                                    <Slider {...settings}>
                                        {book.map((item) => (
                                            <SingleCard {...{
                                                id: item.id,
                                                book_cover_photo: item.book_cover_photo,
                                                book_title: item.book_title,
                                                author_name: item.author_name,
                                                book_price: item.book_price,
                                                discount_price: item.discount_price
                                            }}/>
                                        ))}
                                    </Slider>
                                </Col>
                            </Container>
                        </Container>
                    </Container>
                </section>
            </>
        );
    }
}

export default OnSale;


