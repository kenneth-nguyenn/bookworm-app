import React, {Component} from "react";
import {Card, Col, Row} from "react-bootstrap";
import fallback from "../../public/images/bookcover.jpg";

const MAIN_CURRENCY_SYMBOL = "$"

class SingleCard extends Component {
    constructor(props) {
        super(props);
    }


    render() {
        const price = this.props.discount_price ?
            <Row md={2}>
                <span className={"text-decoration-line-through"}>{this.props.book_price}{MAIN_CURRENCY_SYMBOL}</span>
                <span
                    style={{"fontWeight": "bold"}}>{(this.props.book_price - this.props.discount_price).toFixed(2)}{MAIN_CURRENCY_SYMBOL}</span>
            </Row>
            :
            <Row>
                <Col style={{"fontWeight": "bold"}}>{this.props.book_price}{MAIN_CURRENCY_SYMBOL}</Col>
            </Row>

        const handleClickViewDetailBook = () => {
            // <Nav.Link href="/books">Product Page</Nav.Link>
            console.log(this.props.id)
            // <ProductPage id={this.props.id}/>
        }

        return (
            <>
                {/*<Container fluid>*/}
                {/*<Link to={{*/}
                {/*    pathname:'/books/'+this.props.id,*/}
                {/*    state: {id: this.props.id}*/}
                {/*}} style={{ textDecoration: 'none' }}>*/}
                <Card
                    className={"card-text m-2 my-3"}
                    onClick={handleClickViewDetailBook}
                >
                    <Card.Img
                        variant="top"
                        onError={(e) => (e.currentTarget.src = fallback)}
                        src={"./images/" + this.props.book_cover_photo + ".jpg"}
                        alt={this.props.book_cover_photo}
                        object-fit={"cover"}
                        height={"320rem"}
                    />
                    <Card.Body>
                        <Card.Title>{this.props.book_title}</Card.Title>
                        <Card.Text>{this.props.author_name}</Card.Text>
                    </Card.Body>
                    <Card.Footer className="text-muted">
                        {price}
                    </Card.Footer>
                </Card>
                {/*</Link>*/}
                {/*</Container>*/}
            </>
        );
    }
}

export default SingleCard;
