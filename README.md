<a name="readme-top"></a>

<br/>
<br/>

<div align="center">
  <a href="https://github.com/hosheewashitape1018/">
    <img src="https://file.garden/ZrIPgCGn9kADc89z/blumis.png" alt="Blumies" height="100">
  </a>

<!-- * Description Section -->
<div align="center">
This repository uses a beginner-friendly CodeIgniter 4 template.  
It helps teams quickly bootstrap backend + frontend projects, with simple sample modules that show how to extend the system.
</div>

<br/>


<!-- ! Make sure it was similar to your github -->

---

<br/>
<br/>

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#overview">Overview</a>
      <ol>
        <li>
          <a href="#key-components">Key Components</a>
        </li>
        <li>
          <a href="#technology">Technology</a>
        </li>
      </ol>
    </li>
    <li>
      <a href="#rules-practices-and-principles">Rules, Practices and Principles</a>
    </li>
    <li>
      <a href="#resources">Resources</a>
    </li>
  </ol>
</details>

---

## Overview

This project provides the base layout for **BlumieS**, a CodeIgniter 4 e-commerce website with conventions for organized file structure, component usage, and modular development.

It is designed to be simple to set up and serve as a foundation for expanding new features as BlumieS grows.

**BlumieS** is a student-oriented online shop that sells ID laces, shirts, and other school-related products.

It is designed to be simple to set up and provide a centralized platform for browsing products, placing orders, and managing order information.

**Purpose**: A clean starting point for the BlumieS e-commerce web application.

**Audience**: Developers contributing to BlumieS who want a consistent and maintainable project structure.

### Key Components

| Component | Purpose | Notes |
|---|---|---|
| **User & Auth System** | Handles customer account creation, login, and profile data. | Uses CI4 sessions and the project database for user management. |
| **Product & Collection System** | Manages products, product information, prices, images, and collections. | Designed to support the different products offered by BlumieS. |
| **Shopping Cart & Order System** | Handles cart contents, checkout, order creation, and order information. | Connects customer orders with the database for centralized management. |
| **Admin Dashboard** | Allows administrators to manage products, collections, and customer orders. | Includes order approval, status updates, and product management. |
| **Notification System** | Provides customers with updates about their orders. | Uses predefined messages for statuses such as approved, shipped, delivered, or delayed. |
| **Jotform API Integration** | Synchronizes completed website orders with BlumieS's existing Jotform workflow. | Uses the Jotform API as the project's external API integration. |
| **UI Components Library** | Includes reusable buttons, cards, navigation, forms, and layout templates for consistent UI. | Located under `/views/components` and `/views/layouts`. |

 <!-- ! Start simple. Use these modules as **learning samples**; extend or replace them based on your project’s needs. -->

### Technology

#### Language

![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

#### Framework/Library


![CodeIgniter](https://img.shields.io/badge/CodeIgniter-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)

#### Databases

![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
<!-- ! Keep only the used technology -->

---

## Quick Start (Docker)

Run the development stack and the app (rebuild if needed):

```cmd
docker compose up --watch
```

Common utility commands (run inside the project root):

- Run migrations:

```cmd
docker compose exec php composer migrate
```

- Run seeders:

```cmd
docker compose exec php composer seed
```

- Run tests:

```cmd
docker compose exec php composer test
```

- Create a migration (using CodeIgniter's spark tool):

```cmd
docker compose exec php php spark make:migration CreateUsersTabel
```

- Create a model (using CodeIgniter's spark tool):

```cmd
docker compose exec php php spark make:model UsemModel
```

- Create an entity (value object for a single record) (using CodeIgniter's spark tool):

```cmd
docker compose exec php php spark make:entity Uzer
```

- Create a controller (add --resource to scaffold resourceful methods if you like) (using CodeIgniter's spark tool):

```cmd
docker compose exec php php spark make:controller Usars
```

- Create a seeder (for test/dev data) (using CodeIgniter's spark tool):

```cmd
docker compose exec php php spark make:seeder UserzSeeder
```

If you prefer, you can include `-f "compose.yaml"` explicitly; the shorter commands above work when running from the repo root.

## Ports & Database

Defaults used in this project (host mapping):

| Service     | Host port |
| ----------- | --------: |
| nginx (app) |      8090 |
| phpMyAdmin  |      8091 |
| MySQL       |      3390 |

Database credentials used in examples and CI:

- Host: localhost
- Port: 3390
- Database: app
- User: root
- Password: root

Be careful: seeding and truncating are destructive operations — run only on local/dev environments unless you know what you're doing.

## Rules, Practices and Principles

<!-- ! Dont Revise this -->

1. Always prefix project titles with `AD-`.
2. Place files in their **respective CI4 folders** (`Controllers/`, `Services/`, `Repositories/`, `Views/`).
3. Naming conventions:

   | Type             | Case       | Example                   |
   | ---------------- | ---------- | ------------------------- |
   | Classes          | PascalCase | `UserService.php`         |
   | Interfaces       | PascalCase | `UserRepositoryInterface` |
   | DB tables/fields | snake_case | `users`, `created_at`     |
   | Docs             | kebab-case | `dev-manual.md`           |

4. Git commits use: `feat`, `fix`, `docs`, `refactor`.
5. Use **Controller → Service → Repository** pattern.
6. Assets (CSS/JS/img) live under `public/`.
7. Docker configs are at the repo root (`docker-compose.yml`, `nginx.conf`).
8. Docs are maintained in `/docs` (dev, technical, sop, commit, principles, copilot).

Example structure:

```
AD-ProjectName/
├─ backend/ci4/
│  ├─ app/Controllers/
│  ├─ app/Services/
│  ├─ app/Repositories/
│  ├─ app/Views/
│  ├─ public/
│  ├─ writable/
│  ├─ .env
│  └─ composer.json
├─ docker/               # Docker configs at root
├─ docs/                 # Manuals and project docs
├─ .gitignore
└─ readme.md
```

<!-- ! Dont Revise this -->

---

## Resources

| Title                   | Purpose                                                               | Link                                                                       |
| ----------------------- | --------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| ChatGPT                 | General AI assistance for planning application architecture and docs. | [https://chat.openai.com](https://chat.openai.com)                         |
| GitHub Copilot          | In-IDE code suggestions and boilerplate generation.                   | [https://github.com/features/copilot](https://github.com/features/copilot) |
| YouTube “UI/UX Design”  | Video tutorials on modern web interface layouts and patterns.         | [https://www.youtube.com](https://www.youtube.com)                         |
| Pinterest Design Boards | Inspiration for color schemes, typography, and component layouts.     | [https://www.pinterest.com](https://www.pinterest.com)                     |
| Figma | Inspiration for color schemes, typography, and component layouts.     | [https://www.figma.com](https://www.figma.com/design/udZTjWOdxv4LugdjBaVsZZ/Labubu-Project?node-id=114-34&m=dev&t=MkNDjzX5ud4TUnvb-1)                     |
| File Garden | For image and other types of media hosting | [https://filegarden.com](https://filegarden.com/users/66b20f8021a7f6400373cf73/garden/#aM7j9a-Raxbh-Ych) 
| System Documentation    | Internal docs from PHP, MongoDB, and PostgreSQL used in development.  | — (see `/docs` folder in repo)                                             |

<!-- ! Add what tools aided you -->
