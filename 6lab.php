<?php

// Определяем пользовательские исключения
class InsufficientFundsException extends Exception {}
class InvalidAmountException extends Exception {}

class BankAccount
{
    private int $balance = 0;

    // Метод для пополнения счета
    public function deposit(int &$amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException("Сумма для пополнения должна быть положительной.");
        }
        $this->balance += $amount;
    }

    // Метод для снятия со счета
    public function withdraw(int &$amount): void
    {
        if ($amount <= 0) {
            throw new InvalidAmountException("Сумма для снятия должна быть положительной.");
        }
        if ($amount > $this->balance) {
            throw new InsufficientFundsException("Недостаточно средств на счете.");
        }
        $this->balance -= $amount;
    }

    // Метод для получения текущего баланса
    public function getBalance(): int
    {
        return $this->balance;
    }
}

// Функция для ввода суммы пользователем
function getUserInput(string $prompt): int
{
    echo $prompt;
    $input = trim(fgets(STDIN));

    return (int)$input;
}

// Основная часть программы
function main()
{
    $account = new BankAccount();

    while (true) {
        echo "1. Пополнить счет\n";
        echo "2. Снять со счета\n";
        echo "3. Показать баланс\n";
        echo "4. Выход\n";
        
        $choice = getUserInput("Выберите действие: ");

        switch ($choice) {
            case 1:
                $amount = getUserInput("Введите сумму для пополнения: ");
                try {
                    $account->deposit($amount);
                    echo "Счет пополнен на $amount.\n";
                } catch (InvalidAmountException $e) {
                    echo $e->getMessage() . "\n";
                }
                break;

            case 2:
                $amount = getUserInput("Введите сумму для снятия: ");
                try {
                    $account->withdraw($amount);
                    echo "Со счета снято $amount.\n";
                } catch (InsufficientFundsException $e) {
                    echo $e->getMessage() . "\n";
                } catch (InvalidAmountException $e) {
                    echo $e->getMessage() . "\n";
                }
                break;

            case 3:
                echo "Текущий баланс: " . $account->getBalance() . "\n";
                break;

            case 4:
                echo "Выход из программы.\n";
                return;

            default:
                echo "Неправильный выбор. Пожалуйста, попробуйте снова.\n";
        }
    }
}

// Запуск основной программы
main();
