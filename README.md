# AnyFlow Backend Developer Practical Test: RPC Health Monitoring System

## About AnyFlow

**AnyFlow** is a developer platform that simplifies the deployment, management, and monitoring of smart contracts across multiple blockchains. Our goal is to provide a streamlined experience for developers working with blockchain technology by abstracting away the complexity of handling deployments, retries, gas management, and more. We aim to become the "Web3 DevOps" of blockchain, helping developers focus on building while we handle the operational aspects.

This practical test is part of our hiring process for backend developers. We are looking for candidates who can demonstrate their technical and problem-solving abilities, as well as their communication skills.

## Overview

Your task is to create a system that monitors the health status of several RPC (Remote Procedure Call) providers across different EVM blockchains. The system should monitor, store, and present data about the RPCs such as URL, latency, and current status (online/offline). It should also support CRUD operations for the providers and allow users to freely add, update, and remove providers.

The system must:
- Use the last version of Laravel as the framework.
- Handle asynchronous requests to RPCs to monitor their status.
- Store the results in a database.
- Expose an API to display the status of all providers.
- Allow users to manage the providers through CRUD operations.

## Expected Skills

This test is designed for junior to mid-level backend developers. We expect you to demonstrate proficiency in the following areas:
- Jobs and async processing
- API communication with third-party services
- Database design and CRUD operations
- Error handling and retries in API communication
- General code quality and structure

**Note:** we do not expect you to complete all the bonus points or implement visual interfaces. The main goal is to demonstrate your understanding of the requirements and your ability to implement a working solution.

### Bonus points for:
- Proper unit/integration tests.
- Thoughtful security considerations (e.g., API key storage, rate limiting).
- Scalability or performance improvements.

## Functional Requirements

### 1. Monitor RPC Providers
- The system should make regular asynchronous requests to each provider to check:
  - **Latency**: Time taken to receive a response.
  - **Status**: Online or offline based on a successful response or timeout.

### 2. CRUD Operations
- Implement a way to add, update, or delete RPC providers.
- Each provider should have the following fields:
  - URL
  - Name
  - Chain ID (Ethereum, Binance Smart Chain, etc.)

### 3. API to Expose Data
- Expose an API that returns:
  - A list of all monitored RPC providers.
  - The current status (online/offline) and latency of each provider.
  - Ability to filter results by status or chain.

## Non-Functional Requirements

### 1. Code Quality
- Write clean, maintainable code.
- Add comments where necessary to explain your thought process.
- Make use of design patterns where appropriate (e.g., repository pattern, service layer).

### 2. Database Design
- The database should be designed to store the RPC providers and their health check results.
- Ensure efficient querying and indexing where needed.

### 3. Error Handling
- Handle network issues, timeouts, and failures in API requests gracefully.
- Retry failed requests with exponential backoff (optional, but a plus).

### 4. Documentation
- Provide a **README** file explaining how to run the project.
- Provide a **decisions.md** file explaining the main design decisions and challenges you encountered during the development process.
- (Optional) Write about how you would improve the system if you had more time.

## Evaluation Criteria

- **Functionality**: Does the system work as described in the requirements?
- **Code Quality**: Is the code clean, well-structured, and documented?
- **Database Design**: Is the data model efficient and scalable?
- **Problem-Solving**: Did you approach the task in a logical and structured way?
- **Error Handling**: Are errors handled gracefully and appropriately?
- **Self-Learning**: Did you document your learning process and how you overcame unfamiliar challenges?

## How to Submit

1. Fork this repository and create a new branch with your name.
2. Complete the task and ensure your solution meets the requirements.
3. Push your solution to the forked repository.

## Contact Information

If you have any questions or need clarification, feel free to reach out on Discord or email.

**Contact**: yudi@anyflow.pro
**Discord**: https://discord.gg/aCygGwBWya

Please don’t hesitate to ask questions—communication is an important aspect of this test!

## Good luck!