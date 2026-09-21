using System;
public class Fila<T>
{
    private class No { public T Valor; public No? Proximo; public No(T valor) { Valor = valor; } }
    private No? inicio, fim;
    public int Count { get; private set; }
    public void Enqueue(T valor)
    {
        var novo = new No(valor);
        if (fim == null) inicio = novo; // Primeiro nó da fila.
        else fim.Proximo = novo;       // Liga o antigo fim ao novo nó.
        fim = novo;
        Count++;
    }
    public T Peek()
    {
        if (inicio == null) throw new InvalidOperationException("Fila vazia.");
        return inicio.Valor;
    }
    public T Dequeue()
    {
        T valor = Peek();              // Também verifica se está vazia.
        inicio = inicio!.Proximo;
        if (inicio == null) fim = null; // Não deixe uma referência para o nó removido.
        Count--;
        return valor;
    }
}
public class Program
{
    public static void Main()
    {
        var fila = new Fila<int>();
        fila.Enqueue(10); fila.Enqueue(20); fila.Enqueue(30);
        Console.WriteLine(fila.Dequeue()); // 10
        Console.WriteLine(fila.Peek());    // 20
        Console.WriteLine(fila.Count);     // 2
    }
}
