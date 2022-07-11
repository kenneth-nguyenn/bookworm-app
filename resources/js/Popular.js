import React, {Component} from 'react';
import {Container} from "react-bootstrap";
import axios from "axios";
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import SingleCard from "./SingleCard";

class PopularBooks extends Component {
    constructor(props) {
        super(props);

        this.state = {
            books: [],
        };
    }

    async componentDidMount() {
        let res = await axios.get("http://127.0.0.1:8000/api/books?popular");
        this.setState({books: res ? res.data : []});
    }

    render() {
        const book = this.state.books;
        const settings = {
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 4,
            rows: 2,
            adaptiveHeight: true
        };

        return (
            <Container fluid>
                <Slider {...settings}>
                    {book.map((item) => (
                        <SingleCard {...{
                            id: item.id,
                            book_cover_photo: item.book_cover_photo,
                            book_title: item.book_title,
                            author_name: item.author_name,
                            book_price: item.book_price,
                            discount_price: item.final_price
                        }}/>
                    ))}
                </Slider>
            </Container>
        );
    }
}

export default PopularBooks;
