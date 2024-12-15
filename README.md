<img src="https://github.com/user-attachments/assets/37cb7e20-e584-45d8-b612-4257f051afa2" width="auto" height="200" ></img>
# Question M'ARC Devs

**Created by three students of the HE-Arc's Computer Engineering program**

**Question M'ARC** is a web application built using Laravel, designed to facilitate knowledge-sharing among students. It allows students from various departments to ask course-specific questions, which can then be answered by anyone who might have the solution. When an asker finds a satisfactory answer, they can validate it as a solution. Others watching answers from a question can like them to show their intrest with an answer given.

### Features
- **Search:** Browse through existing questions, type some keywords to check if a question has already been asked.
- **Ask:** Post your own questions to get help.
- **Answer:** Share your knowledge by answering others' questions.
- **Find Solutions:** Get validated answers to solve your problems.

---

## Getting Started

Follow these instructions to set up and run the project on your local machine.

### Prerequisites
Ensure the following are installed on your system:
- **PHP**: Version 8.2.X or higher
- **Composer**
- **Node.js**
- **Database**: 10.4.32 MariaDB or higher

---

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd <repository-folder>
   ```
2. **Dependencies**
   ```bash
   cp .env.example .env
   ```
3. **Configure Environnement**
   ```bash
   composer install
   npm install
   ```
4. **Generation of application key**
   ```bash
   php artisan key:generate
   ```
5. **Set up the Database**
    ```bash
   php artisan migrate:fresh --seed
    ```
7. **Start server**
   ```bash
   php artisan serve
   npm run dev
   ```
