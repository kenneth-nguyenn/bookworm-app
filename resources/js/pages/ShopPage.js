import React, {Component} from 'react';
import {Col, Container, Dropdown, Row,} from "react-bootstrap";
import SingleCard from "../SingleCard";
import axios from "axios";
import AccordionOne from "../Accordion";
import Paginater from "../Pagination";

class ShopPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            books: [],
            dataFromAPI: [],
            currentPage: 1,
            show: {
                selected: 5,
                list: [5, 15, 20, 25]
            },
            typeSortBy: {
                selected: {value: "onsale", name: "Sort by on sale"},
                list: [
                    {value: "onsale", name: "Sort by on sale"},
                    {value: "popularity", name: "Sort by popularity"},
                    {value: "priceAsc", name: "Sort by price low to high"},
                    {value: "priceDesc", name: "Sort by price high to low"}]
            },
            optionFilter: {
                category: {
                    title: "Category",
                    ranges: [
                        {name: "category_name", value: 1},
                        {name: "category #1", value: 2},
                        {name: "category #2", value: 3},
                    ]
                },
                author: {
                    title: "Author",
                    ranges: [
                        {name: "author_name", value: 1},
                        {name: "Author #1", value: 2},
                        {name: "Author #2", value: 3},
                    ]
                },
                ratings: {
                    title: "Rating Review",
                    ranges: [
                        {name: "1 Star", value: 1},
                        {name: "2 Star", value: 2},
                        {name: "3 Star", value: 3},
                        {name: "4 Star", value: 4},
                        {name: "5 Star", value: 5},
                    ]
                }
            },
        };
    }

    async componentDidMount() {
        let res = await axios.get(
            "http://127.0.0.1:8000/api/books",
            {
                params: {
                    sortBy: this.state.typeSortBy.selected.value,
                    show: this.state.show.selected,
                    page: this.state.currentPage,
                }
            });

        this.setState({
            books: res ? res.data.data : 0,
            dataFromAPI: res ? res.data : [],
        });
    }

    handleSelectSortBy = (e, item) => {
        e && item ? this.setState(
            prevState => ({
                typeSortBy: {...prevState.typeSortBy, selected: item},
                currentPage: 1
            }),
            this.componentDidMount) : null
    }

    handleSelectShow = (e, number) => {
        e && number ? this.setState(
            prevState => ({
                show: {...prevState.show, selected: number},
                currentPage: 1
            }),
            this.componentDidMount) : 5
    }

    handleChangePagination = (number) => {
        number ? this.setState(
            {currentPage: number},
            this.componentDidMount) : 1
    }

    render() {
        return (
            <main>
                <Container>
                    <Container fluid>
                        <Col>
                            <Row className={"border-bottom my-1"}>
                                <h6 className={"md-2"} style={{"font-weight": "bold"}}>Books</h6>
                                <p className={"md-auto"}>(Filtered by: )</p>
                            </Row>
                            <Row>
                                <Col md={2} className={"mb-5"}>
                                    <Row>
                                        <h2>Filter By</h2>
                                    </Row>
                                    <Row className={"border p-2 my-2"}>
                                        <AccordionOne dataFill={this.state.optionFilter.category}/>
                                    </Row>
                                    <Row className={"border p-2 my-2"}>
                                        <AccordionOne dataFill={this.state.optionFilter.author}/>
                                    </Row>
                                    <Row className={"border p-2 my-2"}>
                                        <AccordionOne dataFill={this.state.optionFilter.ratings}/>
                                    </Row>
                                </Col>
                                <Col>
                                    <Container fluid>
                                        <Row>
                                            {/*Title showing*/}
                                            <Col>
                                                <p>Showing {this.state.dataFromAPI.from} - {this.state.dataFromAPI.to} of {this.state.dataFromAPI.total} books</p>
                                            </Col>
                                            {/*Type Sort*/}
                                            <Col md="auto">
                                                <Dropdown>
                                                    <Dropdown.Toggle variant="primary">
                                                        {this.state.typeSortBy.selected.name}
                                                    </Dropdown.Toggle>
                                                    <Dropdown.Menu>
                                                        {this.state.typeSortBy.list.map((item) => <Dropdown.Item
                                                            onSelect={(e) => this.handleSelectSortBy(e, item)}
                                                            eventKey={item}>
                                                            {item.name}
                                                        </Dropdown.Item>)}
                                                    </Dropdown.Menu>
                                                </Dropdown>
                                            </Col>
                                            {/*Number Show*/}
                                            <Col md="auto">
                                                <Dropdown>
                                                    <Dropdown.Toggle variant="primary">
                                                        Show {this.state.show.selected}
                                                    </Dropdown.Toggle>
                                                    <Dropdown.Menu>
                                                        {this.state.show.list.map((item) => <Dropdown.Item
                                                            onSelect={(e) => this.handleSelectShow(e, item)}
                                                            eventKey={item}>
                                                            Show {item}
                                                        </Dropdown.Item>)}
                                                    </Dropdown.Menu>
                                                </Dropdown>
                                            </Col>
                                        </Row>
                                    </Container>
                                    <Row md={4}>
                                        {this.state.books.map((book) =>
                                            <Col className={"m-0 mb-3 p-0"}>
                                                <SingleCard {...{
                                                    id: book.id,
                                                    book_cover_photo: book.book_cover_photo,
                                                    book_title: book.book_title,
                                                    author_name: book.author_name,
                                                    book_price: book.book_price,
                                                    discount_price: book.discount_price,
                                                }}/>
                                            </Col>
                                        )}
                                    </Row>
                                    <Row>
                                        <Paginater
                                            total={this.state.dataFromAPI.last_page}
                                            current={this.state.dataFromAPI.current_page}
                                            onChangePage={this.handleChangePagination}/>
                                    </Row>
                                </Col>
                            </Row>
                        </Col>
                    </Container>
                </Container>
            </main>
        );
    }
}

export default ShopPage;
