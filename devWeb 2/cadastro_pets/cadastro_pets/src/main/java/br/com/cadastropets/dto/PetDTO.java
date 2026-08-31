package br.com.cadastropets.dto;

/**
 * Objeto simples so pra conversar com o front-end (evita expor a entidade
 * JPA direto e problemas de serializar classes abstratas em JSON).
 */
public class PetDTO {

    private Integer id;
    private String nome;
    private String tipo;
    private String som;

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    public String getSom() {
        return som;
    }

    public void setSom(String som) {
        this.som = som;
    }
}
