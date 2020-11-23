import React,{ useState } from "react"
import Head from "next/head";
import {Container, Form, Card,FormLabel, FormGroup, Input, Row, Col, Button} from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

async function requestEstimate(date, location){
  //{"createdAt":"2020-11-27 10:00:00","location":"UK"}
  const estimateResponse = await fetch('https://localhost:8443/order/estimate',{
    method:'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({createdAt:date, location: location})
    }
    );

  return estimateResponse.json();
}

const Welcome = () => {
  const [eta, setEta]=useState('');

  return (
    <>
    <Head>
      <title>Delivery Estimate</title>
    </Head>
    <div>
      <Container>
        <Row>
          <Col><h1 className="mt-4 mb-5">Please add the details of the order for the estimation</h1></Col>
        </Row>
        <Row>
          <Col>
            <Card>
              <Card.Body>
                <Form>
                  <FormGroup>
                    <FormLabel>Request date</FormLabel>
                    <input id="createdAtTime" className="float-right" type="time"/>
                    <input id="createdAtDate" className="float-right" type="date"/>
                  </FormGroup>
                  <FormGroup>
                    <FormLabel for="location">Request date</FormLabel>
                    <select name="location" id="location" className="float-right">
                      <option value="UK">United Kingdom</option>
                      <option value="EU">Europe</option>
                      <option value="WORLD">Rest of the world</option>
                    </select>

                  </FormGroup>
                  <FormGroup>
                    <Button block type="submit" onClick={(e)=>{
                      e.preventDefault();
                      let date = document.getElementById('createdAtDate').value;
                      let time = document.getElementById('createdAtTime').value;
                      let dateTime = date+" "+time+":00";
                      let location = document.getElementById('location').value
                      requestEstimate(dateTime,location).then(data => {
                        setEta(data.eta);
                      });
                    }}>Estimate</Button>
                  </FormGroup>
                </Form>
              </Card.Body>
            </Card>
          </Col>
          <Col>
            <Card style={{ width: '18rem' }}>
              <Card.Body><h3>ETA</h3>{eta}</Card.Body>
            </Card>
          </Col>
        </Row>
      </Container>

    </div>


    </>
)};

export default Welcome;
