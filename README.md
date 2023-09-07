# Hardware-Buildup-Support-Sytem
### content
1. Introduction
  - 1.1. Purpose
  - 1.2. Intend Audience and Reading Suggestions
  - 1.3. Project Scope
2. Overall Description
  - 2.1. Product Perspective
  - 2.2. Use case Diagram
  - 2.3. ER Diagram
  - 2.4. Operating Environment
  - 2.5. Budget UI
  - 2.6. Data Flow Diagram
3. System Feature
  - 3.1. Description and Priority
  - 3.2. Functional Requirements
4. Other Non Functional Requirements
  - 4.1. Performance Requirements
  - 4.2. Security Requirements
  - 4.3. Software Quality Attributes
  - 4.4. Business Rules
5. Future Update

## 1. Introduction
  - **1.1 purpose**
    - When someone or a group of people want to run different kinds of software and games, a hardware build up suggestion system can offer direction, suggestions, and insights. This system makes advantage of a number of technological ad- vances to examine user needs, preferences, and restrictions and then generates recommendations for the selection of the computer system’s components that are best suited to those needs.
  - **1.2 Intended Audience and Reading Suggestions**
    - Individuals who are passionate about gaming and require high-performance hardware to run the latest games smoothly.People who engage in tasks like video editing, graphic design, 3D modeling, and other resource-intensive activ- ities.Those who are interested in staying up-to-date with the latest technology trends and want to build their own customized PCs. Individuals who need to set up hardware systems for their workplaces, servers, or data centers
  - **1.3 Project Scope**
    - The scope of this project encompasses the development of a hardware build- up suggestion system designed to assist a diverse range of users in assembling optimal computer configurations. The system will provide recommendations based on users’ specific requirements, such as gaming, designing, or general productivity. It will include a user-friendly interface that allows users to input their preferences, budget constraints, and intended use cases. The system will analyze these inputs and generate well-researched suggestions for components, including processors, graphics cards, memory, storage, and peripherals, while considering compatibility and performance benchmarks. Moreover, the project will involve integrating real-time pricing and availability data to ensure that recommendations remain practical and up-to-date. While the system’s primary focus is on hardware suggestions, basic assembly guidelines and troubleshooting tips may also be included. The project scope does not extend to the actual purchasing or assembly of components, but rather serves as an informative tool to guide users through the initial stages of building or upgrading their own computer systems.
## 2. Overall Description
  - 2.1 Product Perspective
    - The primary users who interact with the system to receive hardware buildup suggestions. They provide input, make selections, and receive recommendations.
  - 2.2 Use case Diagram
    - Figure 1: Usecase
   - 2.3 ER Diagram
      - 2.3.1 User

        - user contains name,id,birth,nationality,gender,image,username etc.Here id is a primary key.
      - 2.3.2 Softwares
        - Software contains id,name,motherboard,cpu,gpu,ram,category,image. Here, id is a primary key. The software table will contain all components id to here and make all combinations for user and user will get hardware suggestion for his desire budget

      - 2.3.3 Games
        - Games Contains id,name,motherboard,cpu,gpu,ram,category, image. Here, id is a primary key. The games table will contain all components id to here and make all combinations for users and user will get hardware suggestion for his desire budget.
 Figure 2: ER
  - 2.4 Operating Environment
      - This software can smoothly run into Windows,MacOs,Linux
  - 2.5 Budget UI
     - Figure 3: Figma

  - 2.6 Data Flow Diagram
     - Figure 4: Data Flow
## 3. System Feature
  - ”Hardware Buildup Suggestion System” is a hardware suggestion software. The feature of this project is give best suggestion according to user budget.
  - 3.1 Description and priority
    - Log in and Signup- User can Log in and Sign Up.
    - Search- User can search games and software.
    - Budget System- User can get suggestion accroding to recommended sug- gestion and user budget system.
    - Review and Report- User can give review,comment and report to other users.
    - Post System- User can give post for his buildup suggestion.
    - Admin- Admin can update database and monitor to users.
  - 3.2 Functional Requirements
    - or frontend- JavaScript,HTML,CSS
    - For backend- Mysql,php,Ajax
## 4. Other Nonfunctional Requirements
  - 4.1 Performance Requirements
    - The system should provide real-time responses to user interactions, such as selecting preferences, changing components, or viewing recommendations. Re- sponse times should be minimal, ensuring a seamless and interactive user expe- rience.
  - 4.2 Security Requirements
    - Without register no user can enter this software. At first, the user has to sign up or register himself or herself to use this software
  - 4.3 Software Quality Attributes
    - Moreover,user conferences and testing are continuous during the development process. In order to maintain the software’s quality and ensure that all require- ments are met.
  - 4.4 Business Rules
    - ”Hardware build-up suggestion system” refers to specific guidelines, policies, or procedures that govern how the system operates, interacts with users, and manages data. These rules help ensure consistency, accuracy, and alignment with the project’s goals.
## 5. Future Update
  - ”Hardware Buildup Suggestion System” is a suggestion based software according to user budget system or recommended system. It will update the AI algorithm in the future with new features.
