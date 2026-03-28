# Contributing to Laravel Livewire Tables 🤝

Thank you for considering contributing to Laravel Livewire Tables! We welcome all types of contributions, from bug reports and documentation improvements to new features and architectural changes.

## 🚀 Getting Started

1.  **Fork the repository** and clone it to your local machine.
2.  **Install dependencies**:
    ```bash
    composer install
    ```
3.  **Setup the development environment**:
    -   Ensure you have PHP 8.1+ and SQLite installed.
    -   The test suite uses an in-memory SQLite database by default.

## 🛠️ Development Workflow

We follow a strict development process to ensure the highest code quality:

### 1. Branching Strategy
-   Create a feature branch from `main`: `feat/your-feature-name` or `fix/your-bug-name`.
-   Keep your PRs focused. If you have multiple unrelated changes, please submit separate PRs.

### 2. Coding Standards
We use **Laravel Pint** for code styling and **PHPStan** for static analysis.
-   **Run Pint**: `vendor/bin/pint`
-   **Run PHPStan**: `vendor/bin/phpstan analyse` (Aim for Level 6 compatibility).

### 3. Documentation
-   If you add a new configuration method or feature, you **must** update the relevant documentation in the `docs/` directory.
-   New features must also be added to the `README.md` features list if significant.

## 🧪 Testing Requirements

Every pull request must include tests to ensure the stability of the package.

-   **Run the test suite**:
    ```bash
    composer test
    ```
-   New features should have at least 90% test coverage in their respective traits.
-   Fixes should include a regression test.

## 📝 Pull Request Guidelines

Before submitting your PR, please ensure:
-   [ ] All tests pass successfully.
-   [ ] Code follows PSR-12 (via Pint).
-   [ ] PHPStan reported no new issues.
-   [ ] Your commit messages are descriptive.
-   [ ] You have updated the documentation where necessary.

## 📜 Code of Conduct

Please note that this project is released with a **[Contributor Code of Conduct](CODE_OF_CONDUCT.md)**. By participating in this project you agree to abide by its terms.

## ⚖️ License

By contributing to this repository, you agree that your contributions will be licensed under its **[MIT License](LICENSE.md)**.